@foreach($items as $item)

    <li id="li-comment-{{$item->id}}" class="comment">
        <div id="comment-{{$item->id}}" class="comment-container">
            <div class="comment-author vcard">
                <img alt="" src="/images/uploads/avatars/{{ $item->user['avatar'] }}" class="avatar" height="75"
                     width="75"/>
                <cite class="fn">{{$item->user['name']}} @if($item->user['is_admin'])
                        {{'(Admin)'}}
                    @endif
                </cite>

            </div>

            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        {{ is_object($item->created_at) ? $item->created_at->format('d.m.Y в H:i') : ''}}
                    </div>

                </div>
                <div class="comment-body">
                    <p>{{ $item->text }}</p>
                </div>

                @if(Auth::user())
                    <div class="reply group">
                        <a class="comment-reply-link" href="#respond"
                           onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->article_id}}&quot;)">Ответить</a>
                    </div>
                @endif
            </div>
        </div>


        @if(isset($com[$item->id]))
            <ul class="children">
                @include('comments.comment', ['items' => $com[$item->id]])
            </ul>
        @endif

    </li>

@endforeach