 <html>
    <head>
    <title>Threads/Index</title>

    <script src="https://unpkg.com/react@15/dist/react.min.js"></script>
    <script src="https://unpkg.com/react-dom@15/dist/react-dom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.38/browser.min.js"></script>

    <link href="css/app.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- <style>
        .thread-table th{
      background-color: #e3342f;
    }
    </style> -->
    </head>
    
    <body>
        <div class = "contents">
        <div class="col-sm-5" style="padding:20px 0; padding-left:0px;">
            <form class="form-inline" action="{{url('/threads')}}">
                <div class="form-group">
                  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="キーワード">
                </div>
            <input type="submit" value="ユーザー検索" name = "search" class="btn btn-info">
            <input type="submit" value="内容検索" name = "search" class="btn btn-info">
            <input type="submit" value="チャンネル名検索" name = "search" class="btn btn-info">
            </form>
        </div>
        @if (!empty($csv))
          <?php //echo $csv ?>
        @endif
             
        <!-- <p><a href="/threads/new/csv?keyword={{$keyword}}&?search={{$search}}">Download</a></p> -->

            <table class = "thread-table">
            <tr>
                <th><p>名前</p></th>
                <th><p>内容</p></th>
                <th><p>チャンネル名</p></th>
            </tr>
                <?php $i = 0 ?>
                @foreach ($items as $item)
                        @if ($i % 2 == 0)
                            <tr>
                                <td><p><a href = "/threads?keyword={{$item -> user_name}}&search=ユーザー検索" > {{$item->user_name}}</a> </p></td>
                                <td><p>{{$item->content}}</p></td>
                                <td><p><a href = "/threads?keyword={{$item -> channel}}&search=チャンネル名検索" >{{$item->channel}}</a></p></td>
                            </tr>
                        @else
                            <tr class = "color">
                                <td><p><a href = "/threads?keyword={{$item -> user_name}}&search=ユーザー検索" > {{$item->user_name}}</a> </p></td>
                                <td><p>{{$item->content}}</p></td>
                                <td><p><a href = "/threads?keyword={{$item -> channel}}&search=チャンネル名検索" >{{$item->channel}}</a></p></td>
                            </tr>
                        @endif
                    <?php $i += 1 ?>
                @endforeach
            </table>
        </div>
    </body>
</html>