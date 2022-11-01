<x-layout>

    <div class="mx-4">
        <x-card class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    建立職缺
                </h2>
                <p class="mb-4">創建職缺吸引求職者</p>
            </header>

            <form id="formAddNewListing">
                <input type="text" class="hidden" name="company.title">
                <p class="text-red-600"></p>


                <div class="mb-6">
                    <label for="company" class="inline-block text-lg mb-2">公司名稱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                        placeholder="請輸入公司名稱" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="title" class="inline-block text-lg mb-2">職務名稱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                        placeholder="例: Laravel工程師" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="location" class="inline-block text-lg mb-2">工作地點</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        placeholder="請輸入工作的地點" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">聯絡信箱</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        placeholder="聯絡信箱" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="website" class="inline-block text-lg mb-2">
                        網頁連結
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="tags" class="inline-block text-lg mb-2">
                        標籤 (以英文逗點分隔)
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                        placeholder="例: Laravel, Backend, Postgres, etc" />
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">
                        公司 LOGO
                    </label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"
                        id="logo" />
                    <p class="text-red-600"></p>
                    <img class="w-48 mr-6 mb-6" id="imgPreview" src="{{ asset('images/no-image.png') }}"
                        alt="" />
                </div>

                <div class="mb-6">
                    <label for="description" class="inline-block text-lg mb-2">
                        職缺描述
                    </label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                        placeholder="對該職務的工作內容做簡易描述"></textarea>
                    <p class="text-red-600"></p>
                </div>

                <div class="mb-6">
                    <button class="bg-main text-white rounded py-2 px-4 hover:bg-black" id="btnAddNewListing">
                        建立職缺
                    </button>

                    <a href="/" class="text-black ml-4"> 上一頁 </a>
                </div>
            </form>
        </x-card>
    </div>

    {{-- <form class="hidden" id="form_redirect" action="{{ route('redirect.flash') }}" method="post">
        @csrf
        <input type="text" name="src" value="listings.create">
        <input type="text" name="to" value="{{ $to }}">
        <button type="submit">submit</button>
    </form> --}}
    @php
        $src = Request::get('src');
        $to = $src == 'listings.manage' ? 'listings.manage' : 'listings.index';
    @endphp
    <x-form-redirect :src="$src" :to="$to"></x-form-redirect>

</x-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    logo.onchange = evt => {
        const [file] = logo.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }
    $('#btnAddNewListing').on('click',
        function(e) {
            e.preventDefault();

            // 清除錯誤訊息
            $('#formAddNewListing input+p').text("");

            const URL_ADD_NEW_LISTING = "{{ route('listings.store') }}";

            // https://stackoverflow.com/questions/2276463/how-can-i-get-form-data-with-javascript-jquery

            var data = new FormData();

            // 設定csrf token
            data.append('_token', "{{ csrf_token() }}");

            // 上傳檔案需特殊處理
            if ($('input[name="logo"]').get(0).files.length !== 0) {
                data.append('logo', $('input[name="logo"]').prop('files')[0]);
            }

            // 將表單中除logo外的欄位全部存入data中
            let x = $("#formAddNewListing").serializeArray();
            $.each(x, function(v) {
                data.append(x[v].name, x[v].value);

            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: URL_ADD_NEW_LISTING,
                type: "POST",
                data: data,
                dataType: 'json',
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(response) {

                    if (response.errors) {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        let errors = response.errors;
                        console.log(errors);

                        for (let o in errors) {
                            // console.log(errors[o][0]);
                            $('#formAddNewListing input[name="' + o + '"]+p').text(errors[o][0]);
                            if(o=='description') {
                                $('#formAddNewListing textarea[name="' + o + '"]+p').text(errors[o][0]);
                            }
                        }
                    }
                    if (response.result == "success") {
                        $("#form_redirect").submit();

                    }

                },
            })

        });
</script>
