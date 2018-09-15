<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitHub extends Model
{

    protected $table = 'github';


    public static $USER = 0;
    public static $REPOSITORY = 1;
    public static $BRANCH = 2;
    public static $COMMIT = 3;

    protected $fillable = [
        'type' ,
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    private static function InsertToGithub( $a , $b) {
        return GitHub::create([
            'type' => $a,
            'data' => $b
        ]);
    }

    public static function InsertAUser($userInfo) {
        return GitHub::InsertToGithub(GitHub::$USER , $userInfo);
    }

    public static function InsertARepo($repoInfo) {
        return GitHub::InsertToGithub(GitHub::$REPOSITORY , $repoInfo);
    }

    public static function InsertABranch($branchInfo) {
        return GitHub::InsertToGithub(GitHub::$BRANCH , $branchInfo);
    }

    public static function InsertACommit($commitInfo) {
        return GitHub::InsertToGithub(GitHub::$COMMIT , $commitInfo);
    }

}
