<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class Discord extends Facade
{
    private static $DISCORD_API_BASE_URL = 'https://discord.com/api';
    private $DISCORD_AVATAR_BASE_URL = 'https://cdn.discordapp.com/avatars';

    protected static function getFacadeAccessor() { return 'discord'; }

    public static function GetGuild($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN'))
        ])->get(sprintf('%s/guilds/%s', self::$DISCORD_API_BASE_URL, $guild_id));
    }

    public static function GetGuildMembers($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN'))
        ])->get(sprintf('%s/guilds/%s/members', self::$DISCORD_API_BASE_URL, $guild_id));
    }

    public static function SendMessage($channel_id, $message = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN')),
        ])->post(sprintf('%s/channels/%s/messages', self::$DISCORD_API_BASE_URL, $channel_id), [
            'content' => $message,
            'tts' => false
        ]);
    }

    public static function SendEmbeddedMessage($channel_id, $title = '', $message = '', $mentions = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN')),
        ])->post(sprintf('%s/channels/%s/messages', self::$DISCORD_API_BASE_URL, $channel_id), [
            'content' => $mentions,
            'tts' => false,
            'embeds' => [
                [
                    'title' => $title,
                    'description' => $message
                ],
            ],
        ]);
    }
}
