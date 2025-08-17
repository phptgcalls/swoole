<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot int commission_permille int duration_months
 * @return StarRefProgram
 */

final class UpdateStarRefProgram extends Instance {
	public function request(object $bot,int $commission_permille,? int $duration_months = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x778b5ab3);
		$flags = 0;
		$flags |= is_null($duration_months) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($bot->read());
		$writer->writeInt($commission_permille);
		if(is_null($duration_months) === false):
			$writer->writeInt($duration_months);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>