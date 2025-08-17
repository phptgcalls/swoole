<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url int date long bot_id int commission_permille long participants long revenue true revoked int duration_months
 * @return ConnectedBotStarRef
 */

final class ConnectedBotStarRef extends Instance {
	public function request(string $url,int $date,int $bot_id,int $commission_permille,int $participants,int $revenue,? true $revoked = null,? int $duration_months = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x19a13f71);
		$flags = 0;
		$flags |= is_null($revoked) ? 0 : (1 << 1);
		$flags |= is_null($duration_months) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		$writer->writeInt($date);
		$writer->writeLong($bot_id);
		$writer->writeInt($commission_permille);
		if(is_null($duration_months) === false):
			$writer->writeInt($duration_months);
		endif;
		$writer->writeLong($participants);
		$writer->writeLong($revenue);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['revoked'] = true;
		else:
			$result['revoked'] = false;
		endif;
		$result['url'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		$result['bot_id'] = $reader->readLong();
		$result['commission_permille'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['duration_months'] = $reader->readInt();
		else:
			$result['duration_months'] = null;
		endif;
		$result['participants'] = $reader->readLong();
		$result['revenue'] = $reader->readLong();
		return new self($result);
	}
}

?>