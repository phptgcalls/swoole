<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string connection_id long user_id int dc_id int date true disabled businessbotrights rights
 * @return BotBusinessConnection
 */

final class BotBusinessConnection extends Instance {
	public function request(string $connection_id,int $user_id,int $dc_id,int $date,? true $disabled = null,? object $rights = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8f34b2f5);
		$flags = 0;
		$flags |= is_null($disabled) ? 0 : (1 << 1);
		$flags |= is_null($rights) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($connection_id);
		$writer->writeLong($user_id);
		$writer->writeInt($dc_id);
		$writer->writeInt($date);
		if(is_null($rights) === false):
			$writer->write($rights->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['disabled'] = true;
		else:
			$result['disabled'] = false;
		endif;
		$result['connection_id'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->readLong();
		$result['dc_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['rights'] = $reader->tgreadObject();
		else:
			$result['rights'] = null;
		endif;
		return new self($result);
	}
}

?>