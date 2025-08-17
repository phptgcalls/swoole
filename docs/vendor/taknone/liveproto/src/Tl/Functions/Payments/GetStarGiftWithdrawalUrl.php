<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsavedstargift stargift inputcheckpasswordsrp password
 * @return payments.StarGiftWithdrawalUrl
 */

final class GetStarGiftWithdrawalUrl extends Instance {
	public function request(object $stargift,object $password) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd06e93a8);
		$writer->write($stargift->read());
		$writer->write($password->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>