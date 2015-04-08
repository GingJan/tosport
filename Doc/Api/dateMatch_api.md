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
##




###发布一条约比赛
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/create`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
match_type | 比赛类型 | Y | varchar(32) | 如：足球
match_place | 比赛地点 | Y | varchar(32) | 如：足球场
match_time | 比赛时间 | Y | int | 时间戳
people_amount | 限定人数上限 | Y | int | 人数上限不能超过50人
content | 附加内容/主题 | N | text | 如果为空则用运动类型自动填补
picture | 附加图片 | N | file | 

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
        "dm_id": "9",
        "creator_id": "2",
        "nickname": "zjien1",
        "avatar": "Public/img/avatar/zjien1.jpg",
        "match_type": "足球",
        "match_place": "足球场",
        "match_time": "1428510717",
        "content": "来踢足球咯",
        "people_amount": "25",
        "booked_amount": "0",
        "picture": "Public/img/match/5525310a97cab.png",
        "create_time": "1428500745"
    }
}
```


###显示同城最新的约运动（按发布时间排序）
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsCityDM`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页 | N | int | 默认1
limit | 每页显示条数 | N | int | 默认10 

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

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页 | N | int | 默认1
limit | 每页显示条数 | N | int | 默认10 

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




###列出约我的人
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsDateGuy`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页 | N | int | 默认1
limit | 每页显示条数 | N | int | 默认10 

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "u_id": "5",
            "nickname": "xiaoli",
            "sex": "女",
            "avatar": null,
            "dm_id": "9",
            "create_time": "1428500900"
        },
        {
            "u_id": "3",
            "nickname": "zjien3",
            "sex": "男",
            "avatar": null,
            "dm_id": "2",
            "create_time": "1428500850"
        },
        {
            "u_id": "1",
            "nickname": "zjien",
            "sex": "男",
            "avatar": "abcdefagaga.jpg",
            "dm_id": "2",
            "create_time": "1428500750"
        }
    ]
}
```



###列出我参加的比赛
ps:该Api需要用户登陆
`POST`

`/Home/DateMatch/listsJoin`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页 | N | int | 默认1
limit | 每页显示条数 | N | int | 默认10 

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dm_id": "6",
            "creator_id": "6",
            "match_type": "橄榄球",
            "match_place": "橄榄球场",
            "match_time": "1445224391",
            "content": "男人之间的比赛，走起",
            "picture": "pic6",
            "joined_time": "1428500915"
        },
        {
            "dm_id": "1",
            "creator_id": "1",
            "match_type": "足球",
            "match_place": "市体育馆",
            "match_time": "1436224391",
            "content": "来一场足球比赛",
            "picture": "pic1",
            "joined_time": "1428500910"
        }
    ]
}
```
####返回字段说明：
字段 | 描述 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
dm_id | 该条约比赛的标识符 | int | 
creator_id | 该条约比赛创建人的id | int | 
match_type | 比赛类型 | string | 即运动类型
match_place | 比赛地点 | string | 
match_time | 比赛时间 | int | 时间戳
content | 附加内容 | text | 
picture | 附加图片 | string | 图片的url
joined_time | 点约时间 | int | 即点击了 约 的时间
##