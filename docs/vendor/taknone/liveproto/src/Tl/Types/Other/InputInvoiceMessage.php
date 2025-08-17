<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id
 * @return InputInvoice
 */

final class InputInvoiceMessage extends Instance {
	public function request(object $peer,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc5b56859);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>