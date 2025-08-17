<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param quickreply quick_reply
 * @return Update
 */

final class UpdateNewQuickReply extends Instance {
	public function request(object $quick_reply) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf53da717);
		$writer->write($quick_reply->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['quick_reply'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>