Api dateExercise
===
>By zjien

`DateExercise 接口`

###发布一条约运动
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/create`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
sport_type | 运动类型 | Y | varchar(32) | 如：网球，羽毛球
sport_place | 运动地点 | Y | varchar(32) | 如：五邑大学1号网球场
sport_time | 运动时间 | Y | int | 时间戳
people_amount | 限定人数上限 | Y | int | 人数上限不能超过25人
content | 附加内容/主题 | N | text | 如果为空则用运动类型自动填补
picture | 附件图片 | N | string | 图片的key
creator_region | 发布者实时位置 | N | varchar(32) | 根据GPS定位获取地理位置
content | 附加内容/主题 | N | text | 字数不能超过140字，如果为空则用运动类型自动填补，

**Response**
```json
{
    "code": 20000,
    "response": "发布成功！"
}
```



###删除一条约运动
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/delete`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
de_id | 要删除的约运动的id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "删除成功!"
}
```



###显示指定某条约运动
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/listsSpeDE`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
de_id | 指定的约运动的id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": {
        "de_id": "1",
        "creator_id": "1",
        "sport_type": "网球",
        "sport_place": "五邑大学1号网球场",
        "sport_time": "1422875858",
        "content": "网球王子，来打网球吧",
        "people_amount": "2",
        "booked_amount": "0",
        "creator_region": "江门",
        "create_time": "1422874342"
    }
}
```




###显示同城最新的约运动（按发布时间排序）
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/listsCityDE`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
my_region | 本人的实时位置 | Y | varchar(32) | GPS定位获取

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "de_id": "7",
            "creator_id": "6",
            "sport_type": "跳舞",
            "sport_place": "五邑大学舞蹈室",
            "sport_time": "1422876257",
            "content": "跳舞咯",
            "people_amount": "5",
            "booked_amount": "0",
            "create_time": "1422874751"
        },
        {
            "de_id": "2",
            "creator_id": "2",
            "sport_type": "篮球",
            "sport_place": "五邑大学风雨篮球场",
            "sport_time": "1422876010",
            "content": "大家来打篮球",
            "people_amount": "10",
            "booked_amount": "0",
            "create_time": "1422874449"
        },
        {
            "de_id": "1",
            "creator_id": "1",
            "sport_type": "网球",
            "sport_place": "五邑大学1号网球场",
            "sport_time": "1422875858",
            "content": "网球王子，来打网球吧",
            "people_amount": "2",
            "booked_amount": "0",
            "create_time": "1422874342"
        }
    ]
}
```




###显示同城热门的约运动（按预约人数排序）
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/listsHotDE`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
my_region | 本人的实时位置 | Y | varchar(32) | GPS定位获取

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "de_id": "7",
            "creator_id": "6",
            "sport_type": "跳舞",
            "sport_place": "五邑大学舞蹈室",
            "sport_time": "1422876257",
            "content": "跳舞咯",
            "people_amount": "5",
            "booked_amount": "4",
            "create_time": "1422874751"
        },
        {
            "de_id": "2",
            "creator_id": "2",
            "sport_type": "篮球",
            "sport_place": "五邑大学风雨篮球场",
            "sport_time": "1422876010",
            "content": "大家来打篮球",
            "people_amount": "10",
            "booked_amount": "3",
            "create_time": "1422874449"
        },
        {
            "de_id": "1",
            "creator_id": "1",
            "sport_type": "网球",
            "sport_place": "五邑大学1号网球场",
            "sport_time": "1422875858",
            "content": "网球王子，来打网球吧",
            "people_amount": "2",
            "booked_amount": "2",
            "create_time": "1422874342"
        }
    ]
}
```




###约Ta
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/dateIt`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
de_id | 要预约的约运动的id | Y | int | 
creator_id | 该条约运动发布人的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "预约运动成功！"
}
```



###取消预约
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/cancelDate`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
de_id | 要取消的约运动的id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "取消成功"
}
```





###列出约我的人
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/listsDateGuy`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页大小 | N |int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "u_id": "2",
            "nickname": "zjien1",
            "sex": "男",
            "avatar": null,
            "de_id": "1",
            "create_time": "1422885327"
        },
        {
            "u_id": "3",
            "nickname": "zjien3",
            "sex": "男",
            "avatar": null,
            "de_id": "1",
            "create_time": "1422882515"
        }
    ]
}
```




###列出我参加的约运动
ps:该Api需要用户登陆
`POST`

`/Home/DateExercise/listsJoin`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页大小 | N |int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dp_id": "13",
            "de_id": "1",
            "creator_id": "1",
            "me_id": "2",
            "create_time": "1422874342",
            "sport_type": "网球",
            "sport_place": "五邑大学1号网球场",
            "sport_time": "1422875858",
            "content": "网球王子，来打网球吧",
            "people_amount": "2",
            "booked_amount": "2",
            "picture": null,
            "creator_region": "江门"
        },
        {
            "dp_id": "12",
            "de_id": "6",
            "creator_id": "5",
            "me_id": "2",
            "create_time": "1422874630",
            "sport_type": "足球",
            "sport_place": "天河体育馆",
            "sport_time": "1422876257",
            "content": "大家来踢足球",
            "people_amount": "13",
            "booked_amount": "1",
            "picture": null,
            "creator_region": "广州"
        },
        {
            "dp_id": "11",
            "de_id": "5",
            "creator_id": "4",
            "me_id": "2",
            "create_time": "1422874577",
            "sport_type": "乒乓球",
            "sport_place": "深圳体育馆",
            "sport_time": "1422876157",
            "content": "大家来打乒乓球咯",
            "people_amount": "3",
            "booked_amount": "1",
            "picture": null,
            "creator_region": "深圳"
        }
    ]
}
```
