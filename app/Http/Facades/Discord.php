<?php

namespace App\Http\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class Discord extends Facade
{
    private static $DISCORD_API_BASE_URL = 'https://discord.com/api';
    private static $DISCORD_AVATAR_BASE_URL = 'https://cdn.discordapp.com/avatars';

    protected static function getFacadeAccessor() { return 'discord'; }

    public static function GetGuild($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', config('app.discord_bot_token'))
        ])->get(sprintf('%s/guilds/%s', self::$DISCORD_API_BASE_URL, $guild_id));
    }

    public static function GetGuildMembers($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', config('app.discord_bot_token'))
        ])->get(sprintf('%s/guilds/%s/members?limit=1000', self::$DISCORD_API_BASE_URL, $guild_id));
    }

    public static function GetGuildChannels($guild_id)
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', config('app.discord_bot_token'))
        ])->get(sprintf('%s/guilds/%s/channels', self::$DISCORD_API_BASE_URL, $guild_id));
    }

    public static function SendMessage($channel_id, $message = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', config('app.discord_bot_token')),
        ])->post(sprintf('%s/channels/%s/messages', self::$DISCORD_API_BASE_URL, $channel_id), [
            'content' => $message,
            'tts' => false
        ]);
    }

    public static function SendEmbeddedMessage($channel_id, $title = '', $message = '', $mentions = '')
    {
        return Http::withHeaders([
            'Authorization' => sprintf('Bot %s', config('app.discord_bot_token')),
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

    // TODO: test
    public static function GetMemberAvatar(User $user) {
        return file_get_contents(sprintf('%s/%s/%s', self::$DISCORD_AVATAR_BASE_URL, $user->id, $user->avatar));
    }
}
