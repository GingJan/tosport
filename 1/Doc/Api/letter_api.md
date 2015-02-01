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



###列出所有的私信，包括收到的和发送的
ps:该Api需要用户登陆
`POST`

`/Home/Letter/listsAllLetter`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | Y | int | 默认为1
limit | 每页显示条数 | Y | int | 默认为15

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "l_id": "7",
            "sender_id": "2",
            "receiver_id": "1",
            "content": "test1",
            "send_time": "1422757801"
        },
        {
            "l_id": "6",
            "sender_id": "1",
            "receiver_id": "1",
            "content": "I want to make friend with you",
            "send_time": "1422757754"
        },
	{
            "l_id": "1",
            "sender_id": "1",
            "receiver_id": "2",
            "content": "hello",
            "send_time": "1422757390"
        }
    ]
}
```
