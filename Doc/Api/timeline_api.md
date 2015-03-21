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
`POST`

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
            "tl_id": "3",
            "sender_id": "1",
            "content": "hello,I'm zjien.This is my third test",
            "create_time": "1422691748",
            "c_amount": null
        },
        {
            "tl_id": "2",
            "sender_id": "1",
            "content": "hello,I'm zjien.This is my second test",
            "create_time": "1422691737",
            "c_amount": 3
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
            "u_id": "3",
            "tl_id": "6",
            "sender_id": "3",
            "nickname": "zjien3",
            "avatar": null,
            "content": "hello,I'm zjien3.my second test",
            "c_amount": null,
            "create_time": "1422691883"
        },
        {
            "u_id": "3",
            "tl_id": "5",
            "sender_id": "3",
            "nickname": "zjien3",
            "avatar": null,
            "content": "hello,I'm zjien3.my first test",
            "c_amount": null,
            "create_time": "1422691870"
        }
    ]
}
```






###显示关注的人的动态（包含我的动态）
ps:该Api需要登陆
`POST`

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
            "u_id": "3",
            "tl_id": "6",
            "sender_id": "3",
            "nickname": "zjien3",
            "avatar": null,
            "content": "hello,I'm zjien3.my second test",
	    "c_amount": null,
            "create_time": "1422691883"
        },
        {
            "u_id": "3",
            "tl_id": "5",
            "sender_id": "3",
            "nickname": "zjien3",
            "avatar": null,
            "content": "hello,I'm zjien3.my first test",
	    "c_amount": null,
            "create_time": "1422691870"
        },
        {
            "u_id": "2",
            "tl_id": "4",
            "sender_id": "2",
            "nickname": "zjien1",
            "avatar": null,
            "content": "hello,I'm zjien1.my first test",
	    "c_amount": null,
            "create_time": "1422691844"
        }
	{
            "u_id": "1",
            "tl_id": "2",
            "sender_id": "1",
            "nickname": "handsomeguy",
            "avatar": null,
            "content": "hello,I'm zjien.This is my second test",
            "c_amount": null,
            "create_time": "1422691737"
        }
    ]
}
```



###显示同城动态
ps:该Api需要登陆
`POST`

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
            "u_id": "6",
            "tl_id": "12",
            "sender_id": "6",
            "nickname": "xiaohong",
            "sex": "女",
            "avatar": null,
            "content": "hello,I'm xiaohong .my test",
	    "c_amount": null,
            "create_time": "1422692023"
        },
        {
            "u_id": "5",
            "tl_id": "10",
            "sender_id": "5",
            "nickname": "xiaoli",
            "sex": "女",
            "avatar": null,
            "content": "hello,I'm xiaoli.my test",
	    "c_amount": null,
            "create_time": "1422691956"
        },
        {
            "u_id": "5",
            "tl_id": "9",
            "sender_id": "5",
            "nickname": "xiaoli",
            "sex": "女",
            "avatar": null,
            "content": "hello,I'm xiaoli.my test",
	    "c_amount": null,
            "create_time": "1422691943"
        },
        {
            "u_id": "1",
            "tl_id": "3",
            "sender_id": "1",
            "nickname": "handsomeguy",
            "sex": "男",
            "avatar": null,
            "content": "hello,I'm zjien.This is my third test",
	    "c_amount": null,
            "create_time": "1422691748"
        },
        {
            "u_id": "1",
            "tl_id": "2",
            "sender_id": "1",
            "nickname": "handsomeguy",
            "sex": "男",
            "avatar": null,
            "content": "hello,I'm zjien.This is my second test",
	    "c_amount": null,
            "create_time": "1422691737"
        }
    ]
}
```