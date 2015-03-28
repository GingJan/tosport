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



###列出收到的私信
ps:该Api需要用户登陆
`POST`

`/Home/Letter/listsReceiveLetter`

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
            "l_id": "7",
            "sender_id": "3",
            "sender_nickname": "zjien3",
            "content": "test1",
            "send_time": "1422757801"
        },
        {
            "l_id": "4",
            "sender_id": "2",
            "sender_nickname": "zjien1",
            "content": "I want to make friend with you",
            "send_time": "1422757567"
        }
    ]
}
```




###列出发出的私信
ps:该Api需要用户登陆
`POST`

`/Home/Letter/listsSendLetter`

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
            "l_id": "5",
            "receiver_id": "4",
            "receiver_nickname": "xiaoming",
            "content": "I want to make friend with you",
            "send_time": "1422757751"
        },
        {
            "l_id": "2",
            "receiver_id": "3",
            "receiver_nickname": "zjien3",
            "content": "I want to make friend with you",
            "send_time": "1422757405"
        },
        {
            "l_id": "1",
            "receiver_id": "2",
            "receiver_nickname": "zjien1",
            "content": "I want to make friend with you",
            "send_time": "1422757390"
        }
    ]
}
```