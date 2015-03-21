Api dateMatch
===
>By zjien

`DateMatch 接口`

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
    "response": [
        {
            "dm_id": "5",
            "creator_id": "5",
            "match_type": "乒乓球",
            "match_place": "乒乓球场2",
            "match_time": "1447224391",
            "content": "乒乓球比赛，走起",
            "picture": "pic5",
            "people_amount": "7",
            "booked_amount": "0",
            "create_time": "1426224682"
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
            "dm_id": "5",
            "creator_id": "5",
            "match_type": "乒乓球",
            "match_place": "乒乓球场2",
            "match_time": "1447224391",
            "content": "乒乓球比赛，走起",
            "picture": "pic5",
            "people_amount": "7",
            "booked_amount": "0",
            "create_time": "1426224682"
        },
        {
            "dm_id": "4",
            "creator_id": "4",
            "match_type": "乒乓球",
            "match_place": "乒乓球场",
            "match_time": "1446224391",
            "content": "来一场乒乓球比赛",
            "picture": "pic4",
            "people_amount": "6",
            "booked_amount": "0",
            "create_time": "1426224643"
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
            "dm_id": "1",
            "creator_id": "1",
            "match_type": "足球",
            "match_place": "市体育馆",
            "match_time": "1436224391",
            "content": "来一场足球比赛",
            "picture": "pic1",
            "people_amount": "30",
            "booked_amount": "15",
            "create_time": "1426224457"
        },
        {
            "dm_id": "3",
            "creator_id": "3",
            "match_type": "网球",
            "match_place": "网球场1",
            "match_time": "1445224391",
            "content": "来一场网球比赛",
            "picture": "pic3",
            "people_amount": "4",
            "booked_amount": "2",
            "create_time": "1426224597"
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