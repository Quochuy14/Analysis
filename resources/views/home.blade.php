<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PHÂN TÍCH VĂN BẢN') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-1">

                {{-- Start Session Document --}}
                <div class=" block p-6 rounded-lg shadow-lg bg-white max-w">
                    <div>           
                        <form action="{{ url('add-document') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-3">
                                    <input type="text" name="doc_symbol" class="form-control
                                        block
                                        w-full
                                        px-3
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-700
                                        bg-white bg-clip-padding
                                        border border-solid border-gray-300
                                        rounded
                                        transition
                                        ease-in-out
                                        m-0
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123"
                                        placeholder="Số kí hiệu"
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="doc_abstract" class="form-control
                                        block
                                        w-full
                                        px-3
                                        py-1.5
                                        text-base
                                        font-normal
                                        text-gray-700
                                        bg-white bg-clip-padding
                                        border border-solid border-gray-300
                                        rounded
                                        transition
                                        ease-in-out
                                        m-0
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput124"
                                        placeholder="Trích yếu"
                                    >
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" name="doc_file" class="form-control block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
                                >
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="
                                    w-50
                                    px-6
                                    py-2.5
                                    bg-blue-600
                                    text-white
                                    font-medium
                                    text-xs
                                    leading-tight
                                    uppercase
                                    rounded
                                    shadow-md
                                    hover:bg-blue-700 hover:shadow-lg
                                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                    active:bg-blue-800 active:shadow-lg
                                    transition
                                    duration-150
                                    ease-in-out">
                                    Thêm
                                </button>
                            </div>
                        </form>
                        @if (isset($messageValid))
                            <p>nef{{$messageValid}}</p>                            
                        @endif
                        @if (isset($documents))
                        <table class="table w-full text-left mb-6 ">
                                <thead class="">
                                    <tr>
                                        <th></th>
                                        <th>SỐ KÍ HIỆU</th>
                                        <th>TRÍCH YẾU</th>
                                        <th>FILE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($documents as $document)
                                    <tbody>    
                                        <tr class="border-b ">
                                            <td class="w-8">
                                                <a href="{{url('home',$document->id)}}" class="text-blue-700"><i class="icon-play"></i></a>
                                            </td>
                                            <td class="w-32">{{$document->doc_symbol}}</td>
                                            <td class="w-64 line-clamp-1 capitalize">{{$document->doc_abstract}}</td>
                                            <td class="w-16">
                                                <a href={{ asset('storage/app/public/document/'.$document->doc_file) }} class="iconDocFile ml-2">File</a>
                                            </td>
                                            <td>
                                                <span  class="text-blue-600 mx-4 openModel"><i class="icon-share"></i></span>
                                                <a href="{{url('delete-document',$document->id)}}" class="text-red-600" onclick="return confirm('Bạn có chắc xóa file này?')"><i class="icon-remove"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        @else
                            <h2 class="text-gray-500 text-center">{{"Chưa có tài liệu nào được lưu"}}</h2>
                        @endif
                    </div>
                </div>
                {{-- End session Document --}}

                {{-- Start Session Job --}}
                <div class=" block p-6 rounded-lg shadow-lg bg-white max-w">
                    <div>
                        @if (isset($jobs))
                            
                            <form action="{{ url('add-job')}}" method="POST">
                                @csrf
                                <input type="text" class="form-control w-12 hidden" readonly name="doc_id" value={{ request()->route('id') }}>
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="form-group mb-3 col-span-6">
                                        <input type="text" name="job_name" id="jobName" class="form-control
                                            block
                                            w-full
                                            px-3
                                            py-1.5
                                            text-base
                                            font-normal
                                            text-gray-700
                                            bg-white bg-clip-padding
                                            border border-solid border-gray-300
                                            rounded
                                            transition
                                            ease-in-out
                                            m-0
                                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123"
                                            placeholder="Công việc"
                                        >
                                    </div>
                                    <div class="form-group mb-3 col-span-4">
                                        <input type="date" name="job_deadline" id="jobDeadline"  class="form-control 
                                            block
                                            w-full
                                            px-3
                                            py-1.5
                                            text-base
                                            font-normal
                                            text-gray-700
                                            bg-white bg-clip-padding
                                            border border-solid border-gray-300
                                            rounded
                                            transition
                                            ease-in-out
                                            m-0
                                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput124"
                                            min="2022-01-01"
                                            max="2030-01-01"
                                            placeholder="Hạn xử lý"
                                        >
                                    </div>
                                    <div class="form-group mb-3 col-span-2">
                                        <button type="submit" id="saveJobBtn" class="
                                            w-full
                                            px-6
                                            py-2.5
                                            bg-blue-600
                                            text-white
                                            font-medium
                                            text-xs
                                            leading-tight
                                            uppercase
                                            rounded
                                            shadow-md
                                            hover:bg-blue-700 hover:shadow-lg
                                            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                            active:bg-blue-800 active:shadow-lg
                                            transition
                                            duration-150
                                            ease-in-out">
                                            Lưu
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if ($jobs->count())
                                <table class="table w-full text-left mb-6 ">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>CÔNG VIỆC</th>
                                            <th>HẠN XỬ LÝ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                        @foreach ($jobs as $job)
                                            <tbody>
                                                <tr class="border-b mainJob">
                                                    <td class="w-12 numberOder"></td>
                                                    <td class="w-60 capitalize line-clamp-2 job-name">{{$job->job_name}}</td>
                                                    <td class="timeDeadline job-deadline">{{$job->job_deadline ? date('d-m-Y', strtotime($job->job_deadline)) : ""}}</td>
                                                    <td>
                                                        <a href="#" class="editJob text-blue-700 mx-3"><i class="icon-pencil"></i></a>
                                                        <a href="{{ url('delete-job',$job->id) }}" class="text-red-600"><i class="icon-remove"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </thead>
                                </table>
                            @else
                                <h3 class="text-gray-700 text-center">Không có công việc nào được lưu</h3>
                            @endif
                        @endif
                    </div>
                </div>
                {{-- End Session Job --}}

            </div>  
        </div>
    </div>

    <script>
        const $ = document.querySelector.bind(document);
        const $$ = document.querySelectorAll.bind(document);

        // define the file type and set icon to it
        const hrefDocFile = $$(".iconDocFile");
        for(var i of hrefDocFile){
            const type = i.href.slice(-3);
            if(type == 'ocx' || type == 'doc'){
                i.classList.add('text-blue-700');
                i.innerHTML = "<i class='fa fa-file-word-o'></i>"
            }
            else if(type == 'pdf'){
                i.classList.add('text-red-600');
                i.innerHTML = "<i class='fa fa-file-pdf-o'></i>"
            }else{
                i.classList.add('text-gray-700');
                i.innerHTML = "<i class='fa fa-file-o'></i>"
                i.href = '';
            }
        }

        //get cuuren day/month/year
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // Months start at 0!
        let dd = today.getDate();
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;

        const formattedToday = dd + '/' + mm + '/' + yyyy;

        // define to deadline
        const timeDeadlines = $$('.timeDeadline');
        for(var time of timeDeadlines){
            timeCurrent = time.textContent;

            if(timeCurrent < formattedToday){
                time.style.color = "red";
            }else{
                time.style.color = "blue";
            }
        }

        // set number order to job table
        const numberOders = $$('.numberOder');
        var number = 0;
        for(var numberOder of numberOders ){
            numberOder.textContent = ++ number
        }

        // Edit job
        const jobs = $$('.editJob');
        const jobName = $('#jobName');
        const jobDeadline = $('#jobDeadline');

        
        for(var job of jobs){
            job.onclick = function(e){
                e.preventDefault()
                const bodyJob = e.target.closest(".mainJob");

                const valueJobName = bodyJob.querySelector('.job-name').textContent;
                const valueJobDeadline = bodyJob.querySelector('.job-deadline').textContent;
                jobName.value = valueJobName;
                if(valueJobDeadline){
                    jobDeadline.value = changeYMD(valueJobDeadline);
                }
            }
        }

        function changeYMD(date){
            const day = date.slice(0, 2);
            const month = date.slice(3, 5);
            const year = date.slice(6, 10);

            const time = year + "-" + month + "-" + day;
            return time;
        }
    </script>
</x-app-layout>
