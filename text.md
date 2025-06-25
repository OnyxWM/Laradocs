## This is a post showing how the format of markdown is

```php
 public function store(Request $request, Post $post)
    {
        $data = $request->validate(['body' => ['required', 'string', 'max:255']]);

        $post->comments()->create([...$data, 'user_id' => $request->user()->id]);

        return to_route('posts.show', $post)->withFragment('comments');
    }
```

### this is pretty cool

```html
<body>
    <div>
        <p>this is a paragraph</p>
    </div>
</body>
```

this is html
