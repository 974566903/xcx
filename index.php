<?php
$actName = $_GET['actName'];

$actName();// 调用方法
// 是否显示工具栏方法
function is_tool(){
	$toolStatus = 0;// 1 显示 0不显示
	exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>['isTool'=>$toolStatus])));
}
// 步数提示信息
function noticeInfo(){
	// 微信最新消息
    $stepInfo['wxInfo'] = [
              	            	['id'=>100001,'name'=>'使用必看事项','color'=>'blue',
            'notice'=>[
                  '特别提醒：安卓/苹果下载“小米运动”然后手机注册，不要下面的第三方账号授权登陆！', 
              ]
            ],
            	['id'=>100001,'name'=>'','color'=>'red',
            'notice'=>[
                  '重要事情说三遍：不是小米账号！是小米运动、小米运动、小米运动！小米账号≠小米运动',
                  
              ]
            ],
            ['id'=>100001,'name'=>'','color'=>'green ',
            'notice'=>[
                  '不是无法使用！为了避免封号。凌晨00~上午9点可能会无法同步。其他时间随意刷10分钟内同步。',
                  
              ]
            ]
        ];
      	// 支付宝最新消息
      	$stepInfo['zfbInfo'] = [
          	 ['id'=>100000,'name'=>'注意事项说明','color'=>'red',
              'notice'	=>[
         '1、从应用商店或者浏览器下载小米运动App，打开软件并输入手机号登录，不要使用第三方账号登录',
         '2、点击我的->第三方接入，绑定你想同步数据的项目 注：同步wx运动请按照要求关注公众号。',
         '3、到小程序界面收入手机→密码→步数→提交步数',
         '4、大约1分钟后步数即可自动同步至你绑定的所有平台。',
         '5、（但是官方app的步数却不会及时刷新，有延迟，可以点击APP首页的步数数字再返回这样多刷新几次。）',
              ]
            ],
          	['id'=>100000,'name'=>'注册说明','color'=>'green',
              'notice'	=>[
              '部分问题：一直提示账号密码错误',
              '请注意需要用小米运动账号，而不是小米账号，没有的话就在APP里直接注册一个。',
              ]
            ],
           
             ['id'=>100000,'name'=>'温馨提示','color'=>'red',
              'notice'	=>[
                ' 本工具仅提供学习交流,请勿用于非法用途！',
              ]
            ],
            
        ];
    	exit(json_encode(['status'=>1,'msg'=>'获取信息成功','result'=>$stepInfo]));
}
// curl数据请求方法
function curlRequest($url, $data=array(), $method = 'POST'){
    $method = strtoupper($method);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $param = http_build_query($data);
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        $param =str_replace('&amp;','&',$param);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    } else {
        if ($param) {
            $url = (stripos($url, "?") === false) ? ($url . "?" . $param) : ($url . '&amp;' . $param);
            $url =str_replace('&amp;','&',$url);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
