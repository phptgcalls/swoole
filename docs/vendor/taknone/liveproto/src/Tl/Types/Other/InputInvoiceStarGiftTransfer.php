<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift inputpeer to_id
 * @return InputInvoice
 */

final class InputInvoiceStarGiftTransfer extends Instance {
	public function request(object $stargift,object $to_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4a5f5bd9);
		$writer->write($stargift->read());
		$writer->write($to_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stargift'] = $reader->tgreadObject();
		$result['to_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>