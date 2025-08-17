<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long req_msg_id int now Vector<future_salt> salts
 * @return FutureSalts
 */

final class FutureSalts extends Instance {
	public function request(int $req_msg_id,int $now,array $salts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xae500895);
		$writer->writeLong($req_msg_id);
		$writer->writeInt($now);
		$writer->tgwriteVector($salts,'future_salt');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['req_msg_id'] = $reader->readLong();
		$result['now'] = $reader->readInt();
		$result['salts'] = $reader->tgreadVector('future_salt');
		return new self($result);
	}
}

?>