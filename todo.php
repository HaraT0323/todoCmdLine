<?php
// function定義
// タスク情報の作成
function createTask(&$taskList)
{
    echo '登録するタスク情報を入力して下さい' . PHP_EOL;
    $content = trim(fgets(STDIN));
    $task = array(
        'content'     => $content,
        'status'      => '未完了',
        'created_at'  => date("Y-m-d H:i:s"),
        'finished_at' => '-',
    );
    array_push($taskList, $task);
}

// タスク情報の出力
function outputTasks($taskList)
{
    foreach ($taskList as $key => $value) {
        echo 'タスク番号:' . $key . PHP_EOL;
        echo '内容:' . $value['content'] . PHP_EOL;
        echo 'ステータス:' . $value['status'] . PHP_EOL;
        echo '登録日:' . $value['created_at'] . PHP_EOL;
        echo '完了日:' . $value['finished_at'] . PHP_EOL;
    }
}
// タスクのステータスの変更
function changeStatus(&$taskList)
{
    outputTasks($taskList);
    echo 'ステータスを変更するタスク番号を選択して下さい' . PHP_EOL;
    $num = trim(fgets(STDIN));
    $task = &$taskList[$num];
    if (!empty($task)) {
        if ($task['status'] === '未完了') {
            $task['status'] = '完了';
            $task['finished_at'] = date("Y-m-d H:i:s");
        } else {
            $task['status'] = '未完了';
            $task['finished_at'] = '-';
        }
        echo 'タスクのステータスを更新しました' . PHP_EOL;
    } else {
        echo 'タスクが存在しません。再度選びなおして下さい' . PHP_EOL;
    }
}
// メイン処理
$taskList = [];
while (true) {
    echo '実行するメニューを選択して下さい' . PHP_EOL;
    echo '1: タスクを表示する' . PHP_EOL;
    echo '2: タスクを表示する(closeのみ)' . PHP_EOL;
    echo '3: タスクを表示する(openのみ)' . PHP_EOL;
    echo '4: タスクを登録する' . PHP_EOL;
    echo '5: タスクのステータスを変更' . PHP_EOL;
    echo '9: 終了' . PHP_EOL;
    echo '番号を選択して下さい(1,2,3,4,5,9) :';
    $num = trim(fgets(STDIN));
    // 選択した番号に応じて処理の切り分け
    if ($num === '1') {
        outputTasks($taskList);
    } elseif ($num === '4') {
        createTask($taskList);
    } elseif ($num === '5') {
        changeStatus($taskList);
    } else {
        break;
    }
}
