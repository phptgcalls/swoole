<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id int commission_permille int duration_months int end_date starsamount daily_revenue_per_user
 * @return StarRefProgram
 */

final class StarRefProgram extends Instance {
	public function request(int $bot_id,int $commission_permille,? int $duration_months = null,? int $end_date = null,? object $daily_revenue_per_user = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdd0c66f2);
		$flags = 0;
		$flags |= is_null($duration_months) ? 0 : (1 << 0);
		$flags |= is_null($end_date) ? 0 : (1 << 1);
		$flags |= is_null($daily_revenue_per_user) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($bot_id);
		$writer->writeInt($commission_permille);
		if(is_null($duration_months) === false):
			$writer->writeInt($duration_months);
		endif;
		if(is_null($end_date) === false):
			$writer->writeInt($end_date);
		endif;
		if(is_null($daily_revenue_per_user) === false):
			$writer->write($daily_revenue_per_user->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['bot_id'] = $reader->readLong();
		$result['commission_permille'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['duration_months'] = $reader->readInt();
		else:
			$result['duration_months'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['end_date'] = $reader->readInt();
		else:
			$result['end_date'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['daily_revenue_per_user'] = $reader->tgreadObject();
		else:
			$result['daily_revenue_per_user'] = null;
		endif;
		return new self($result);
	}
}

?>