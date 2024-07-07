<div
    class="flex flex-col bg-white shadow-button rounded-lg min-h-screen flex-grow lg:max-w-[400px] mt-8 lg:mt-0 shrink-0">
    <div class="border-b">
        <div class="flex py-6 px-8 gap-x-4">
            <img src="{{ asset($dataStudent->gender == 'Male' ? 'images/img_dashboard_maleStudent.png' : 'images/img_dashboard_femaleStudent.png') }}"
                class="lg:w-20 lg:h-20 w-32 h-32" alt="">
            <div class="flex flex-col py-2 overflow-x-hidden flex-grow">
                <span class="font-semibold lg:max-w-52 uppercase">{{ auth()->user()->name }}</span>
                <span>{{ $dataStudent->student_id }}</span>
                <span>{{ $dataStudent->classroom->name ?? 'N/A' }}</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-5 justify-items-center p-4 lg:py-4 lg:px-4 gap-4 lg:gap-4">
        @foreach ($exam->questions as $index => $question)
            <button
                class="question-nav shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border hover:bg-gray-100">{{ $index + 1 }}</button>
        @endforeach
    </div>
    <div class="flex-grow"></div>
    <div class="flex flex-col gap-y-2 place-content-end border-t py-4 align-middle">
        <span class="flex gap-x-2 px-4">
            <div class="w-5 h-5 rounded-md bg-white border shadow"></div>Not Answered
        </span>
        <span class="flex gap-x-2 px-4">
            <div class="w-5 h-5 rounded-md bg-accent-1 shadow"></div>Answered
        </span>
        <span class="flex gap-x-2 px-4">
            <div class="w-5 h-5 rounded-md bg-white border-accent-1 border-2 shadow"></div>Currently Seeing
        </span>
        <span class="flex gap-x-2 px-4">
            <div class="w-5 h-5 rounded-md bg-yellow-400 shadow"></div>Marked (Not Answered)
        </span>
        <span class="flex gap-x-2 px-4">
            <div class="w-5 h-5 rounded-md bg-cyan-300 shadow"></div>Marked (Answered)
        </span>
    </div>
</div>
