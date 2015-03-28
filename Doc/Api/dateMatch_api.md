Api dateMatch
===
>By zjien

`DateMatch 接口`



####各字段的解释
字段 | 描述 | 备注
--------------------- | ----------------- | ---------------------------
dm_id | 该条约比赛的id |
creator_id | 创建该条约比赛用户的id |
nickname | 创建该约比赛用户的昵称
avatar | 创建该约比赛用户的头像
match_type | 比赛类型 | 亦即运动类型 |
match_place | 比赛地点 |
match_time | 比赛时间 |
content | 附加内容 | 
picture | 附加图片 |
people_amount | 需要的总人数 |
booked_amount | 已预约人数 |
create_time | 该条约比赛的发布时间 |




###发布一条约比赛
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/create`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
match_type | 比赛类型 | Y | varchar(32) | 如：足球
match_place | 比赛地点 | Y | varchar(32) | 如：足球场
match_time | 比赛时间 | Y | int | 时间戳
content | 附加内容/主题 | N | text | 如果为空则用运动类型自动填补
picture | 附加图片 | N | varchar(64) | 
people_amount | 限定人数上限 | Y | int | 人数上限不能超过50人

**Response**
```json
{
    "code": 20000,
    "response": "发布成功！"
}
```



###删除一条约比赛
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/delete`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
dm_id | 要删除的约比赛的id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "删除成功!"
}
```


###显示指定某条约比赛
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsSpeDM`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
dm_id | 指定的约比赛的id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": {
        "dm_id": "1",
        "creator_id": "1",
        "nickname": "zjien",
        "avatar": "abcdefagaga.jpg",
        "match_type": "足球",
        "match_place": "市体育馆",
        "match_time": "1436224391",
        "content": "来一场足球比赛",
        "people_amount": "30",
        "booked_amount": "15",
        "picture": "pic1",
        "create_time": "1426224457"
    }
}
```


###显示同城最新的约运动（按发布时间排序）
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsCityDM`

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dm_id": "7",
            "creator_id": "2",
            "nickname": "zjien1",
            "avatar": null,
            "match_type": "足球",
            "match_place": "五邑大学足球场",
            "match_time": "1426695263",
            "content": "来比赛",
            "people_amount": "25",
            "booked_amount": "1",
            "picture": "thisisakey",
            "create_time": "1426595381"
        },
        {
            "dm_id": "6",
            "creator_id": "6",
            "nickname": "xiaohong",
            "avatar": null,
            "match_type": "橄榄球",
            "match_place": "橄榄球场",
            "match_time": "1445224391",
            "content": "男人之间的比赛，走起",
            "people_amount": "30",
            "booked_amount": "0",
            "picture": "pic6",
            "create_time": "1426224756"
        }
    ]
}
```


###显示同城热门的约运动（按预约人数排序）
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsHotDM`

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dm_id": "7",
            "creator_id": "2",
            "nickname": "zjien1",
            "avatar": null,
            "match_type": "足球",
            "match_place": "五邑大学足球场",
            "match_time": "1426695263",
            "content": "来比赛",
            "people_amount": "25",
            "booked_amount": "1",
            "picture": "thisisakey",
            "create_time": "1426595381"
        },
        {
            "dm_id": "6",
            "creator_id": "6",
            "nickname": "xiaohong",
            "avatar": null,
            "match_type": "橄榄球",
            "match_place": "橄榄球场",
            "match_time": "1445224391",
            "content": "男人之间的比赛，走起",
            "people_amount": "30",
            "booked_amount": "0",
            "picture": "pic6",
            "create_time": "1426224756"
        }
    ]
}
```


###约Ta
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/dateIt`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
dm_id | 要预约的约比赛的id | Y | int | 
creator_id | 该条约比赛发布人的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "成功约到！"
}
```


###取消预约
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/cancelDate`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
de_id | 要取消的约比赛的de_id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "成功约到！"
}
```