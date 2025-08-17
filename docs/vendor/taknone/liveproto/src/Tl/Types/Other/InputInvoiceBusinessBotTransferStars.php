<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot long stars
 * @return InputInvoice
 */

final class InputInvoiceBusinessBotTransferStars extends Instance {
	public function request(object $bot,int $stars) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf4997e42);
		$writer->write($bot->read());
		$writer->writeLong($stars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bot'] = $reader->tgreadObject();
		$result['stars'] = $reader->readLong();
		return new self($result);
	}
}

?>