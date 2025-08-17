<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id int count long random_id paidreactionprivacy private
 * @return Updates
 */

final class SendPaidReaction extends Instance {
	public function request(object $peer,int $msg_id,int $count,int $random_id,? object $private = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58bbcb50);
		$flags = 0;
		$flags |= is_null($private) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeInt($count);
		$writer->writeLong($random_id);
		if(is_null($private) === false):
			$writer->write($private->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>