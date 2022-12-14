@php
    session()->forget('message');
@endphp

<x-layout>


    <div class="mx-4">
        <x-card class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    編輯職缺
                </h2>
                <p class="mb-4">修改下方內容進行編輯</p>
            </header>

            {{-- <form id="formEditListing" enctype="multipart/form-data"> --}}
            <form id="formEditListing" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="company" class="inline-block text-lg mb-2">公司名稱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                        placeholder="請輸入公司名稱" value={{ $listing->company }} />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="title" class="inline-block text-lg mb-2">職務名稱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                        placeholder="Example: Senior Laravel Developer" value="{{ $listing->title }}" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="location" class="inline-block text-lg mb-2">工作地點</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        placeholder="Example: Remote, Boston MA, etc" value="{{ $listing->location }}" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">聯絡信箱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        placeholder="聯絡信箱" value="{{ $listing->email }}" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="website" class="inline-block text-lg mb-2">
                        網頁連結
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
                        value="{{ $listing->website }}" />

                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="tags" class="inline-block text-lg mb-2">
                        標籤(用逗號分開)
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                        placeholder="Example: Laravel, Backend, Postgres, etc" value="{{ $listing->tags }}" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">
                        公司Logo
                    </label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"
                        id="logo" />
                    <p class="text-red-600"></p>
                    <img class="w-48 mr-6 mb-6" id="imgPreview"
                        src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }}"
                        alt="" />

                </div>

                <div class="mb-6">
                    <label for="description" class="inline-block text-lg mb-2">
                        職缺描述
                    </label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                        placeholder="Include tasks, requirements, salary, etc" value="{{ $listing->description }}"></textarea>
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <button class="bg-main text-white rounded py-2 px-4 hover:bg-black" id="btnEditListing">
                        更新職缺
                    </button>

                    <a href="{{ url()->previous() }}" class="text-black ml-4"> 返回 </a>
                </div>
            </form>
        </x-card>
    </div>

</x-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>


<script>
    logo.onchange = evt => {
        const [file] = logo.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }
    $('#btnEditListing').on('click',
        function(e) {
            e.preventDefault();

            // 清除錯誤訊息
            $('#formEditListing input+p').text("");

            const URL = "{{ route('listings.update', ['listing' => $listing]) }}";

            // https://stackoverflow.com/questions/2276463/how-can-i-get-form-data-with-javascript-jquery

            let data = new FormData();

            // 設定csrf token
            data.append('_token', "{{ csrf_token() }}");

            // 上傳檔案需特殊處理
            if ($('input[name="logo"]').get(0).files.length !== 0) {
                data.append('logo', $('input[name="logo"]').prop('files')[0]);
            }

            // 將表單中除logo外的欄位全部存入data中
            let x = $("#formEditListing").serializeArray();
            $.each(x, function(v) {
                data.append(x[v].name, x[v].value);

            });

            // 加上id
            data.append('id', "{{ $listing->id }}");

            // for (const value of data.values()) {
            //     console.log(value);
            // }





            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    // 'X-Requested-With': 'XMLHttpRequest',
                    // 'content-type':'application/json',
                }
            });
            $.ajax({
                url: URL,
                type: "post",
                data: data,
                // dataType: 'json',
                // mimeType: 'multipart/form-data',
                // cache:false,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(response) {
                    console.log(response);
                    if (response.errors) {
                        let errors = response.errors;

                        for (let o in errors) {
                            // console.log(errors[o][0]);
                            $('#formEditListing input[name="' + o + '"]+p').text(errors[o][0]);
                            if(o=='description') {
                                $('#formEditListing textarea[name="' + o + '"]+p').text(errors[o][0]);
                            }
                        }
                    }
                    if (response.status == "success") {
                        // @php
                        //     session()('message' , '職缺已更新');
                        // @endphp

                        window.location.href =
                            "{{ route('listings.manage', ['listing' => $listing, 'user_id' => auth()->user()->id]) }}";
                    }


                },
            })



        });
</script>
