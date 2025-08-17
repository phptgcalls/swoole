<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash true unconfirmed int date string device string location
 * @return Update
 */

final class UpdateNewAuthorization extends Instance {
	public function request(int $hash,? true $unconfirmed = null,? int $date = null,? string $device = null,? string $location = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8951abef);
		$flags = 0;
		$flags |= is_null($unconfirmed) ? 0 : (1 << 0);
		$flags |= is_null($date) ? 0 : (1 << 0);
		$flags |= is_null($device) ? 0 : (1 << 0);
		$flags |= is_null($location) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($hash);
		if(is_null($date) === false):
			$writer->writeInt($date);
		endif;
		if(is_null($device) === false):
			$writer->tgwriteBytes($device);
		endif;
		if(is_null($location) === false):
			$writer->tgwriteBytes($location);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['unconfirmed'] = true;
		else:
			$result['unconfirmed'] = false;
		endif;
		$result['hash'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['date'] = $reader->readInt();
		else:
			$result['date'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['device'] = $reader->tgreadBytes();
		else:
			$result['device'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['location'] = $reader->tgreadBytes();
		else:
			$result['location'] = null;
		endif;
		return new self($result);
	}
}

?>