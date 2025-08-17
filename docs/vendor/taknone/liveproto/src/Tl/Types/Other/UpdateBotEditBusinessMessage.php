<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string connection_id message message int qts message reply_to_message
 * @return Update
 */

final class UpdateBotEditBusinessMessage extends Instance {
	public function request(string $connection_id,object $message,int $qts,? object $reply_to_message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7df587c);
		$flags = 0;
		$flags |= is_null($reply_to_message) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($connection_id);
		$writer->write($message->read());
		if(is_null($reply_to_message) === false):
			$writer->write($reply_to_message->read());
		endif;
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['connection_id'] = $reader->tgreadBytes();
		$result['message'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['reply_to_message'] = $reader->tgreadObject();
		else:
			$result['reply_to_message'] = null;
		endif;
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>