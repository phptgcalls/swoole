<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputcheckpasswordsrp password true ton long amount
 * @return payments.StarsRevenueWithdrawalUrl
 */

final class GetStarsRevenueWithdrawalUrl extends Instance {
	public function request(object $peer,object $password,? true $ton = null,? int $amount = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2433dc92);
		$flags = 0;
		$flags |= is_null($ton) ? 0 : (1 << 0);
		$flags |= is_null($amount) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($amount) === false):
			$writer->writeLong($amount);
		endif;
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