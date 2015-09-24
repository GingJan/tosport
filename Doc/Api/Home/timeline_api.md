Api timeline
===
>By zjien

`Timeline 接口`

###发送一条动态/打卡
ps:该Api需要用户登陆
`POST`

`/Home/Timeline/send`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
content | 动态内容 | Y | text | 不能为空，字数不超过140字
picture | 附加图片 | N | string | 七牛返回的key

**Response**
```json
{
    "code": 20000,
    "response": "发表成功"
}
```



###删除自己某条动态
ps:该Api需要用户登陆
`POST`

`/Home/Timeline/delete`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
tl_id | 动态表对应的tl_id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "删除成功"
}
```



###显示本人发过的动态
ps:该Api需要登陆
`GET`

`/Home/Timeline/listsMyTimeline`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "tl_id": "15",
            "content": "这是文件上传",
            "picture": "Public/img/timeline/5524f228e6a29.jpg",
            "create_time": "1428484647",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        },
        {
            "tl_id": "4",
            "content": "hello,I'm zjien1.my first test",
            "picture": null,
            "create_time": "1422691844",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        }
    ]
}
```



###显示某个人的动态
ps:该Api需要登陆
`POST`

`/Home/Timeline/listsSpeTimeline`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------------------------
u_id | 被显示人的u_id | Y | int | 如要显示用户A的动态，则这里的u_id就是用户A的u_id
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "tl_id": "6",
            "content": "hello,I'm zjien3.my second test",
            "picture": null,
            "create_time": "1422691883",
            "c_amount": "1",
            "like_amount": null,
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        },
        {
            "tl_id": "5",
            "content": "hello,I'm zjien3.my first test",
            "picture": null,
            "create_time": "1422691870",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        }
    ]
}
```




###显示指定某一条动态
ps:该Api需要登陆
`POST`

`/Home/Timeline/listsOneTimeline`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------------------------
tl_id | 动态id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "tl_id": "6",
            "content": "hello,I'm zjien3.my second test",
            "picture": null,
            "create_time": "1422691883",
            "c_amount": "1",
            "like_amount": null,
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        }
    ]
}
```




###显示关注的人的动态（包含我的动态）
ps:该Api需要登陆
`GET`

`/Home/Timeline/listsAllTimeline`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "tl_id": "15",
            "content": "这是文件上传",
            "picture": "Public/img/timeline/5524f228e6a29.jpg",
            "create_time": "1428484647",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        },
        {
            "tl_id": "7",
            "content": "hello,I'm xiaoming.my first test",
            "picture": null,
            "create_time": "1422691919",
            "c_amount": "1",
            "like_amount": "2",
            "sender_id": "4",
            "sender_nickname": "xiaoming",
            "sender_avatar": null
        },
        {
            "tl_id": "4",
            "content": "hello,I'm zjien1.my first test",
            "picture": null,
            "create_time": "1422691844",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        }
    ]
}
```



###显示同城动态
ps:该Api需要登陆
`GET`

`/Home/Timeline/listsCityTimeline`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认10

以下返回的数据均为同城的数据
**response**
```json
{
    "code": 20000,
    "response": [
        {
            "tl_id": "15",
            "content": "这是文件上传",
            "picture": "Public/img/timeline/5524f228e6a29.jpg",
            "create_time": "1428484647",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        },
        {
            "tl_id": "8",
            "content": "hello,I'm xiaoli.my second  test",
            "picture": null,
            "create_time": "1422691928",
            "c_amount": null,
            "like_amount": "1",
            "sender_id": "5",
            "sender_nickname": "xiaoli",
            "sender_avatar": null
        },
        {
            "tl_id": "7",
            "content": "hello,I'm xiaoming.my first test",
            "picture": null,
            "create_time": "1422691919",
            "c_amount": "1",
            "like_amount": "2",
            "sender_id": "4",
            "sender_nickname": "xiaoming",
            "sender_avatar": null
        },
        {
            "tl_id": "4",
            "content": "hello,I'm zjien1.my first test",
            "picture": null,
            "create_time": "1422691844",
            "c_amount": null,
            "like_amount": null,
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "sender_avatar": "Public/img/avatar/zjien1.jpg"
        }
    ]
}
```