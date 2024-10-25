<x-userlist-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">トピック一覧</h1>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">投稿タイトル</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成者</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                        </tr>
                    </thead>
                    @foreach ($topics as $topic)
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 border-t-2 border-gray-200">{{ ($topic->title)}}</td>
                                @if( $topic->user )
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ ($topic->user->username )}}</td>
                                @else
                                    <td class="px-4 py-3 border-t-2 border-gray-200">ユーザーがいません</td>
                                @endif
                                <td class="px-4 py-3 border-t-2 border-gray-200">{{ $topic->created_at->format('Y-m-d H:i:s')}}</td>
                                <td class="px-4 py-3 text-lg text-gray-900 border-t-2 border-gray-200">
                                    <form id="delete-form" action="{{ route('admin.topic.destroy', ['id' => $topic->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn delete-link text-red-700" onclick="confirmDelete()">削除</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
        </div>
    </section>

    <script>
        function confirmDelete() {
            if (confirm("本当に削除しますか？")) {
                // ユーザーが「はい」を選択した場合
                // フォームを送信
                document.getElementById("delete-form").submit();
            }
        }
    </script>
</x-userlist-layout>