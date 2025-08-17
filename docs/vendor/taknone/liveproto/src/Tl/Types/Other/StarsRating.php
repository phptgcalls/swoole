<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int level long current_level_stars long stars long next_level_stars
 * @return StarsRating
 */

final class StarsRating extends Instance {
	public function request(int $level,int $current_level_stars,int $stars,? int $next_level_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1b0e4f07);
		$flags = 0;
		$flags |= is_null($next_level_stars) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($level);
		$writer->writeLong($current_level_stars);
		$writer->writeLong($stars);
		if(is_null($next_level_stars) === false):
			$writer->writeLong($next_level_stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['level'] = $reader->readInt();
		$result['current_level_stars'] = $reader->readLong();
		$result['stars'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['next_level_stars'] = $reader->readLong();
		else:
			$result['next_level_stars'] = null;
		endif;
		return new self($result);
	}
}

?>