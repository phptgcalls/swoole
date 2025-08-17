<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<MessageRange> ranges true exclude_new_messages
 * @return ChannelMessagesFilter
 */

final class ChannelMessagesFilter extends Instance {
	public function request(array $ranges,? true $exclude_new_messages = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcd77d957);
		$flags = 0;
		$flags |= is_null($exclude_new_messages) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteVector($ranges,'MessageRange');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['exclude_new_messages'] = true;
		else:
			$result['exclude_new_messages'] = false;
		endif;
		$result['ranges'] = $reader->tgreadVector('MessageRange');
		return new self($result);
	}
}

?>