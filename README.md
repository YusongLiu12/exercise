# 项目管理系统
主要代码在xampp\htdocs\thinkphp5文件夹里，但是因为还有数据库数据啥的
# User Account
# 重置密码后初始密码为initial0000
| username  | name | password | access_level |
| ------------- | ------------- | ------------- | ------------- |
| zhangsan  | zhangsan张三  | 333 | administrator |
| lisi | 李四  | lisi444  | normal user |
| wangwu | 王五  | wangwu555  | normal user |
| zhaoliu | 赵六  | zhaoliu666  | normal user |
| sunqi | 孙七  | sunqi777  | normal user |
| zhouba | 周八  | zhouba888  | normal user |
| wujiu | 吴九  | wujiu999  | normal user |
| zhengshi | 郑十  | zhengshi101010  | normal user |
| liushiyi | 刘十一  | liushiyi111111  | normal user |
| peishier | 裴十二  | peishier121212  | normal user |

# 项目管理
所有人都能创建新的公开或私有项目，创建项目后将自动加入，编辑和删除自己创建的项目，邀请其他人加入自己的私有项目，加入其他人创建的公开项目，不能主动加入其他人创建的私有项目，通过项目名称查询项目，查看每个项目的项目名称、创建者、访问类型、项目参与成员，未加入的私有项目的所有信息将被隐藏； 

管理员能编辑和删除所有项目；  

普通用户不能编辑和删除其他人创建的项目；  

私有项目只能通过创建者邀请加入。  

# 用户管理
所有人都能通过用户名搜索用户，修改自己的密码，查看每位用户的、姓名、访问权限、参与项目，不能删除自己     

管理员能够查看所有用户的用户名，重置所有人的密码，编辑和删除所有用户，新增用户；  

普通用户只能查看自己的用户名，编辑和删除自己，不能新增用户。  

# 任务管理
项目内所有成员都能编辑任务，通过任务标题和任务状态查询任务，添加事件，查看每个任务的任务标题、负责人、任务状态、开始时间、结束时间、状态修改记录、事件记录；  

项目创建者能新增任务，修改任务的标题、状态、负责人、开始时间、结束时间；  

非项目创建者不能新增任务，只能修改任务的状态。

# 删除操作
删除用户时将删除所有该用户与其参与项目的关联记录，同时删除该用户创建的所有项目与负责的任务   

删除项目时将删除所有该项目与其参与成员的关联记录，同时删除该项目内所有任务



