Api comment
===
>By zjien

`Comment 接口`

###对某条动态发表评论/回复某用户
ps:该Api需要用户登陆
`POST`

`/Home/Comment/sendComment`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
content | 评论内容 | Y | text | 内容不能为空
tl_id | 动态表的id | Y | int | 对哪条(tl_id)动态评论
receiver_id | 接收人的u_id | Y | int | 可以使发布该动态的人的id也可以是其他人的id(回复其他人)

**Response**
```json
{
    "code": 20000,
    "response": "评论成功"
}
```


###对某动态 点/取消 赞
ps:该Api需要用户登陆
`POST`

`/Home/Comment/like`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
tl_id | 动态表的id | Y | int | 对哪条(tl_id)动态点/取消赞
receiver_id | 发表该动态人的u_id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "点赞成功"
}
```

**如果已点赞，再点会取消**
**Response**
```json
{
    "code": 20000,
    "response": "取消赞成功"
}
```


###显示自己发的评论
ps:该Api需要用户登陆
`POST`

`/Home/Comment/listsMyComment`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
me_id | 本人u_id | Y | int | 也即评论发送者的id


**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "c_id": "12",
            "tl_id": "5",
            "sender_id": "32",
            "receiver_id": "3",
            "send_time": "1426514849",
            "content": "hello,my name is beeasy,want to know you,",
            "like": null
        }
    ]
}
```



###删除评论（只限删除自己发出的评论）
ps:该Api需要用户登陆
`POST`

`/Home/Comment/deleteComment`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
c_id | 评论表的id | Y | int | 对应Comment表的c_id


**Response**
```json
{
    "code": 20000,
    "response": "删除成功"
}
```



###显示所有收到的评论和赞
ps:该Api需要用户登陆
pps:返回的like字段为1说明被人点赞了，否则为NULL
`POST`

`/Home/Comment/listsAllComment`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页显示条数 | N | int | 默认为10


**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "c_id": "10",
            "u_id": "3",
            "tl_id": "2",
            "nickname": "zjien3",
            "avatar": null,
            "c_sender_id": "3",
            "c_receiver_id": "1",
            "content": null,
            "like": "1",
            "send_time": "1422695089",
            "tl_sender_id": "1",
            "c_amount": "5"
        },
        {
            "c_id": "5",
            "u_id": "3",
            "tl_id": "2",
            "nickname": "zjien3",
            "avatar": null,
            "c_sender_id": "3",
            "c_receiver_id": "1",
            "content": "hi,I am zjien3 ,I make a Comment",
            "like": null,
            "send_time": "1422694592",
            "tl_sender_id": "1",
            "c_amount": "5"
        },
        {
            "c_id": "3",
            "u_id": "1",
            "tl_id": "2",
            "nickname": "handsomeguy",
            "avatar": null,
            "c_sender_id": "1",
            "c_receiver_id": "2",
            "content": "hi,glad to see you too",
            "like": null,
            "send_time": "1422694517",
            "tl_sender_id": "1",
            "c_amount": "5"
        },
        {
            "c_id": "2",
            "u_id": "2",
            "tl_id": "2",
            "nickname": "zjien1",
            "avatar": null,
            "c_sender_id": "2",
            "c_receiver_id": "1",
            "content": "hello,nice to meet you ,I'm zjien1 whats up",
            "like": null,
            "send_time": "1422693689",
            "tl_sender_id": "1",
            "c_amount": "5"
        },
        {
            "c_id": "1",
            "u_id": "2",
            "tl_id": "2",
            "nickname": "zjien1",
            "avatar": null,
            "c_sender_id": "2",
            "c_receiver_id": "1",
            "content": "hello,nice to meet you ,I'm zjien1",
            "like": null,
            "send_time": "1422693636",
            "tl_sender_id": "1",
            "c_amount": "5"
        }
    ]
}
```



###显示某条动态的评论和赞
ps:该Api需要用户登陆
`POST`

`/Home/Comment/listsSpeComment`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
tl_id | 指定动态的tl_id | Y | int |  
page | 当前页码 | N | int | 默认为1
limit | 每页显示条数 | N | int | 默认为15

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "c_id": "12",
            "u_id": "3",
            "tl_id": "4",
            "nickname": "zjien3",
            "avatar": null,
            "c_sender_id": "3",
            "c_receiver_id": "1",
            "content": null,
            "like": "1",
            "send_time": "1422695089",
            "tl_sender_id": "1",
            "c_amount": "5"
        },
	{
            "c_id": "13",
            "u_id": "2",
            "tl_id": "4",
            "nickname": "zjien1",
            "avatar": null,
            "c_sender_id": "2",
            "c_receiver_id": "1",
            "content": "hello,nice to meet you ,I'm zjien1",
            "like": null,
            "send_time": "1422693636",
            "tl_sender_id": "1",
            "c_amount": "5"
        }
    ]
}
```
