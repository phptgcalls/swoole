<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer recipient_id int date peer sender_id textwithentities message
 * @return StarGiftAttribute
 */

final class StarGiftAttributeOriginalDetails extends Instance {
	public function request(object $recipient_id,int $date,? object $sender_id = null,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe0bff26c);
		$flags = 0;
		$flags |= is_null($sender_id) ? 0 : (1 << 0);
		$flags |= is_null($message) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($sender_id) === false):
			$writer->write($sender_id->read());
		endif;
		$writer->write($recipient_id->read());
		$writer->writeInt($date);
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['sender_id'] = $reader->tgreadObject();
		else:
			$result['sender_id'] = null;
		endif;
		$result['recipient_id'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>