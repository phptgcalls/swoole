<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> chats
 * @return PrivacyRule
 */

final class PrivacyValueDisallowChatParticipants extends Instance {
	public function request(array $chats) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x41c87565);
		$writer->tgwriteVector($chats,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chats'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>