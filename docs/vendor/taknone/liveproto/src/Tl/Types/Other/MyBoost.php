<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int slot int date int expires peer peer int cooldown_until_date
 * @return MyBoost
 */

final class MyBoost extends Instance {
	public function request(int $slot,int $date,int $expires,? object $peer = null,? int $cooldown_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc448415c);
		$flags = 0;
		$flags |= is_null($peer) ? 0 : (1 << 0);
		$flags |= is_null($cooldown_until_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($slot);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		$writer->writeInt($date);
		$writer->writeInt($expires);
		if(is_null($cooldown_until_date) === false):
			$writer->writeInt($cooldown_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['slot'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['peer'] = $reader->tgreadObject();
		else:
			$result['peer'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['expires'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['cooldown_until_date'] = $reader->readInt();
		else:
			$result['cooldown_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>