<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson data true save
 * @return InputPaymentCredentials
 */

final class InputPaymentCredentials extends Instance {
	public function request(object $data,? true $save = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3417d728);
		$flags = 0;
		$flags |= is_null($save) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($data->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['save'] = true;
		else:
			$result['save'] = false;
		endif;
		$result['data'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>