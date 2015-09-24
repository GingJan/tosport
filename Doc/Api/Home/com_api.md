API Com
===
>By zjien

`Com 接口`
##该API完成基本功能


###获取七牛上传凭证
ps:该Api需要用户登陆
`POST`

`/Home/Com/uploadToken`

**Response**
```json
{
    "code": 20000,
    "response": 'Token_String'
}
```


###获取七牛下载凭证
ps:该Api需要用户登陆
`POST`

`/Home/Com/uploadToken`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
key | 要下载文件的名字/标识符 | Y | string | 

**Response**
```json
{
    "code": 20000,
    "response": 'Token_String'
}
```