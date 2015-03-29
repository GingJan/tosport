#基本说明：

基础URL：`http://tosport.sinaapp.com/index.php`
##

#返回数据格式说明：
###以下为json格式：

#####`操作成功`
**Response**
```json
{
	"code": 20000,
	"response": [Json格式数据集  或  操作成功提示信息]
}
```
##


#####`操作失败`
**Response**
```json
{
	"error_code": 40000,
	"msg": "错误提示信息"
}
```
##

另外请注意：u_id代表UserInfo表的id标示、f_id代表Friend表的id标示

