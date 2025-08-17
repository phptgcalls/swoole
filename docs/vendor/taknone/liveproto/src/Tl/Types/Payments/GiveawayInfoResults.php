<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int start_date int finish_date int winners_count true winner true refunded string gift_code_slug long stars_prize int activated_count
 * @return payments.GiveawayInfo
 */

final class GiveawayInfoResults extends Instance {
	public function request(int $start_date,int $finish_date,int $winners_count,? true $winner = null,? true $refunded = null,? string $gift_code_slug = null,? int $stars_prize = null,? int $activated_count = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe175e66f);
		$flags = 0;
		$flags |= is_null($winner) ? 0 : (1 << 0);
		$flags |= is_null($refunded) ? 0 : (1 << 1);
		$flags |= is_null($gift_code_slug) ? 0 : (1 << 3);
		$flags |= is_null($stars_prize) ? 0 : (1 << 4);
		$flags |= is_null($activated_count) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($start_date);
		if(is_null($gift_code_slug) === false):
			$writer->tgwriteBytes($gift_code_slug);
		endif;
		if(is_null($stars_prize) === false):
			$writer->writeLong($stars_prize);
		endif;
		$writer->writeInt($finish_date);
		$writer->writeInt($winners_count);
		if(is_null($activated_count) === false):
			$writer->writeInt($activated_count);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['winner'] = true;
		else:
			$result['winner'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['refunded'] = true;
		else:
			$result['refunded'] = false;
		endif;
		$result['start_date'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['gift_code_slug'] = $reader->tgreadBytes();
		else:
			$result['gift_code_slug'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['stars_prize'] = $reader->readLong();
		else:
			$result['stars_prize'] = null;
		endif;
		$result['finish_date'] = $reader->readInt();
		$result['winners_count'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['activated_count'] = $reader->readInt();
		else:
			$result['activated_count'] = null;
		endif;
		return new self($result);
	}
}

?>