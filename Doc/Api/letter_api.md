Api letter
===
>By zjien

`Letter 接口`

###发送私信
ps:该Api需要用户登陆

`POST`

`/Home/Letter/send`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
content | 私信内容 | Y | text | 不能为空
receiver_id | 收信人u_id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "发送成功！"
}
```



###获取消息列表
ps:该Api需要用户登陆
`POST`

`/Home/Letter/getList`

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
            "l_id": "10",
            "sender_id": "3",
            "receiver_id": "1",
            "title": "3-1",
            "content": "test 2",
            "send_time": "1422758010",
            "isread": "1",
            "unread_count": "0",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        },
        {
            "l_id": "4",
            "sender_id": "2",
            "receiver_id": "1",
            "title": "2-1",
            "content": "I want to make friend with you",
            "send_time": "1422757567",
            "isread": "0",
            "unread_count": "1",
            "sender_nickname": "zjien1",
            "sender_avatar": null
        }
    ]
}
```




###获取与某人的对话记录
ps:该Api需要用户登陆
`POST`

`/Home/Letter/getRecord`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
sender_id | 某人的id | Y | int | 即发送该私信人的id 
page | 当前页码 | N | int | 默认为1
limit | 每页显示条数 | N | int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "l_id": "10",
            "receiver_id": "1",
            "receiver_nickname": "zjien",
            "receiver_avatar": "abcdefagaga.jpg",
            "title": "3-1",
            "content": "test 2",
            "isread": "0",
            "send_time": "1422758010",
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        },
        {
            "l_id": "7",
            "receiver_id": "1",
            "receiver_nickname": "zjien",
            "receiver_avatar": "abcdefagaga.jpg",
            "title": "3-1",
            "content": "test1",
            "isread": "0",
            "send_time": "1422757801",
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "sender_avatar": null
        }
    ]
}
```