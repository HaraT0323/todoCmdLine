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

function extTasks($taskList)
{
    $extTaskList = [];
    echo '抽出するメニューを選択して下さい' . PHP_EOL;
    echo '1: 完了したタスクを抽出' . PHP_EOL;
    echo '2: 未完了のタスクを抽出' . PHP_EOL;
    echo '3: キーワードでタスクを抽出' . PHP_EOL;
    $num = trim(fgets(STDIN));

    switch ($num) {
        case '1':
            $extTaskList = array_filter($taskList, function ($task) {
                return $task['status'] === '完了';
            });
        case '2':
            $extTaskList = array_filter($taskList, function ($task) {
                return $task['status'] === '未完了';
            });
        case '3';
            echo '検索したいキーワードを入力して下さい' . PHP_EOL;
            $keyword = trim(fgets(STDIN));
            $extTaskList = array_filter($taskList, function ($task) use ($keyword) {
                return strpos($task['content'], $keyword) === 0;
            });
    }
    outputTasks($extTaskList);
}
// メイン処理
// テスト用データー
$taskList = [
    [
        'content'     => 123,
        'status'      => '未完了',
        'created_at'  => date("Y-m-d H:i:s"),
        'finished_at' => '-',
    ],
    [
        'content'     => 456,
        'status'      => '完了',
        'created_at'  => date("Y-m-d H:i:s"),
        'finished_at' => date("Y-m-d H:i:s"),
    ],
    [
        'content'     => 'zzzz',
        'status'      => '未完了',
        'created_at'  => date("Y-m-d H:i:s"),
        'finished_at' => '-',
    ],
    [
        'content'     => 'zzzz',
        'status'      => '完了',
        'created_at'  => date("Y-m-d H:i:s"),
        'finished_at' => date("Y-m-d H:i:s"),
    ],
];
while (true) {
    echo '実行するメニューを選択して下さい' . PHP_EOL;
    echo '1: タスクを表示する' . PHP_EOL;
    echo '2: タスクを抽出して表示する' . PHP_EOL;
    echo '3: タスクを登録する' . PHP_EOL;
    echo '4: タスクのステータスを変更' . PHP_EOL;
    echo '9: 終了' . PHP_EOL;
    echo '番号を選択して下さい(1,2,3,4,5,9) :';
    $num = trim(fgets(STDIN));
    // 選択した番号に応じて処理の切り分け
    if ($num === '1') {
        outputTasks($taskList);
    } elseif ($num === '2') {
        extTasks($taskList);
    } elseif ($num === '3') {
        createTask($taskList);
    } elseif ($num === '4') {
        changeStatus($taskList);
    } else {
        break;
    }
}
