<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift true keep_original_details
 * @return InputInvoice
 */

final class InputInvoiceStarGiftUpgrade extends Instance {
	public function request(object $stargift,? true $keep_original_details = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4d818d5d);
		$flags = 0;
		$flags |= is_null($keep_original_details) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($stargift->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['keep_original_details'] = true;
		else:
			$result['keep_original_details'] = false;
		endif;
		$result['stargift'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>