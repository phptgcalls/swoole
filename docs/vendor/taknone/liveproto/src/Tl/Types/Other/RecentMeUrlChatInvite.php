<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url chatinvite chat_invite
 * @return RecentMeUrl
 */

final class RecentMeUrlChatInvite extends Instance {
	public function request(string $url,object $chat_invite) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeb49081d);
		$writer->tgwriteBytes($url);
		$writer->write($chat_invite->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['chat_invite'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>