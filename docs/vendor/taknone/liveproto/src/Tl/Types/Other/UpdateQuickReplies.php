<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<QuickReply> quick_replies
 * @return Update
 */

final class UpdateQuickReplies extends Instance {
	public function request(array $quick_replies) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf9470ab2);
		$writer->tgwriteVector($quick_replies,'QuickReply');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['quick_replies'] = $reader->tgreadVector('QuickReply');
		return new self($result);
	}
}

?>