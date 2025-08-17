<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel long send_paid_messages_stars true broadcast_messages_allowed
 * @return Updates
 */

final class UpdatePaidMessagesPrice extends Instance {
	public function request(object $channel,int $send_paid_messages_stars,? true $broadcast_messages_allowed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4b12327b);
		$flags = 0;
		$flags |= is_null($broadcast_messages_allowed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->writeLong($send_paid_messages_stars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>