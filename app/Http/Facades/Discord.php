<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class Discord extends Facade
{
    protected static function getFacadeAccessor() { return 'discord'; }

    public static function GetGuild($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN'))
        ])->get(sprintf('https://discord.com/api/guilds/%s', $guild_id));
    }

    public static function GetGuildMembers($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN'))
        ])->get(sprintf('https://discord.com/api/guilds/%s/members', $guild_id));
    }

    public static function SendMessage($channel_id, $message = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN')),
        ])->post(sprintf('https://discord.com/api/channels/%s/messages', $channel_id), [
            'content' => $message,
            'tts' => false
        ]);
    }

    public static function SendEmbeddedMessage($channel_id, $title = '', $message = '', $mentions = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', env('DISCORD_BOT_TOKEN')),
        ])->post(sprintf('https://discord.com/api/channels/%s/messages', $channel_id), [
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
