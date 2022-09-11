<x-layout>

    <div class="mx-4">
        <x-card class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create a Gig
                </h2>
                <p class="mb-4">Post a gig to find a developer</p>
            </header>

            <form id="formAddNewListing">
                <div class="mb-6">
                    <label for="company" class="inline-block text-lg mb-2">Company Name</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
                        placeholder="請輸入公司名稱" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="title" class="inline-block text-lg mb-2">Job Title</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                        placeholder="Example: Senior Laravel Developer" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="location" class="inline-block text-lg mb-2">Job Location</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        placeholder="Example: Remote, Boston MA, etc" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        placeholder="聯絡信箱" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="website" class="inline-block text-lg mb-2">
                        Website/Application URL
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="tags" class="inline-block text-lg mb-2">
                        Tags (Comma Separated)
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                        placeholder="Example: Laravel, Backend, Postgres, etc" />
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">
                        Company Logo
                    </label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"
                        id="logo" />
                    <p class="text-red-200"></p>
                    <img class="w-48 mr-6 mb-6" id="imgPreview" src="{{ asset('images/no-image.png') }}"
                        alt="" />
                </div>

                <div class="mb-6">
                    <label for="description" class="inline-block text-lg mb-2">
                        Job Description
                    </label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                        placeholder="Include tasks, requirements, salary, etc"></textarea>
                    <p class="text-red-200"></p>
                </div>

                <div class="mb-6">
                    <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" id="btnAddNewListing">
                        Create Gig
                    </button>

                    <a href="/" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </x-card>
    </div>

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
                    console.log(response);
                    if (response.errors) {
                        let errors = response.errors;

                        for (let o in errors) {
                            // console.log(errors[o][0]);
                            $('#formAddNewListing input[name="' + o + '"]+p').text(errors[o][0]);
                        }
                    }
                    if (response.status == "success") {

                        @php
                        session(['message' => '已成功新建職缺']);
                        @endphp

                        window.location.href = "{{ route('listings.index') }}";




                    }


                },
            })



        });
</script>
