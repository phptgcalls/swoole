<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int period long auto_setting_from
 * @return MessageAction
 */

final class MessageActionSetMessagesTTL extends Instance {
	public function request(int $period,? int $auto_setting_from = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c134d7b);
		$flags = 0;
		$flags |= is_null($auto_setting_from) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($period);
		if(is_null($auto_setting_from) === false):
			$writer->writeLong($auto_setting_from);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['period'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['auto_setting_from'] = $reader->readLong();
		else:
			$result['auto_setting_from'] = null;
		endif;
		return new self($result);
	}
}

?>