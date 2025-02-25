<div>
    <div class="flex items-center space-x-4">
        <div class="flex space-x-2">
            <button
                wire:click="upvote"
                class="flex items-center space-x-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                :class="{ 'bg-blue-500 text-white': @entangle('hasUpvoted'), 'bg-gray-200 hover:bg-gray-300 text-gray-700': !@entangle('hasUpvoted') }"
                x-data
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                </svg>
                <span>Like</span>
            </button>

            <button
                wire:click="downvote"
                class="flex items-center space-x-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                :class="{ 'bg-red-500 text-white': @entangle('hasDownvoted'), 'bg-gray-200 hover:bg-gray-300 text-gray-700': !@entangle('hasDownvoted') }"
                x-data
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25c.478-.276.923-.608 1.306-.977A5.983 5.983 0 0 0 9.5 13.5c0-.758-.128-1.486-.362-2.164" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 13.75c-.806 0-1.533.446-2.031 1.08a9.041 9.041 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 0 0-.322 1.672V21.25a.75.75 0 0 1-.75.75 2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282m0 0H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77c.483 0 .964.078 1.423.23l3.114 1.04a4.501 4.501 0 0 0 1.423.23h1.294m-1.811 11.25c-.082-.205-.173-.405-.27-.602-.197-.4.078-.898.523-.898h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 1.302-4.665c0-1.194-.232-2.333-.654-3.375Z" />
                </svg>
                <span>Dislike</span>
            </button>
        </div>

        <div class="text-right">
            <span class="font-semibold">{{ $voteTotal }}</span>
            <span class="text-gray-500 text-sm">votes</span>
        </div>
    </div>
</div>