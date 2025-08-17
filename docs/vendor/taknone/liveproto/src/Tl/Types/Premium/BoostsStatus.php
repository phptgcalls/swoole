<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int level int current_level_boosts int boosts string boost_url true my_boost int gift_boosts int next_level_boosts statspercentvalue premium_audience Vector<PrepaidGiveaway> prepaid_giveaways Vector<int> my_boost_slots
 * @return premium.BoostsStatus
 */

final class BoostsStatus extends Instance {
	public function request(int $level,int $current_level_boosts,int $boosts,string $boost_url,? true $my_boost = null,? int $gift_boosts = null,? int $next_level_boosts = null,? object $premium_audience = null,? array $prepaid_giveaways = null,? array $my_boost_slots = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4959427a);
		$flags = 0;
		$flags |= is_null($my_boost) ? 0 : (1 << 2);
		$flags |= is_null($gift_boosts) ? 0 : (1 << 4);
		$flags |= is_null($next_level_boosts) ? 0 : (1 << 0);
		$flags |= is_null($premium_audience) ? 0 : (1 << 1);
		$flags |= is_null($prepaid_giveaways) ? 0 : (1 << 3);
		$flags |= is_null($my_boost_slots) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($level);
		$writer->writeInt($current_level_boosts);
		$writer->writeInt($boosts);
		if(is_null($gift_boosts) === false):
			$writer->writeInt($gift_boosts);
		endif;
		if(is_null($next_level_boosts) === false):
			$writer->writeInt($next_level_boosts);
		endif;
		if(is_null($premium_audience) === false):
			$writer->write($premium_audience->read());
		endif;
		$writer->tgwriteBytes($boost_url);
		if(is_null($prepaid_giveaways) === false):
			$writer->tgwriteVector($prepaid_giveaways,'PrepaidGiveaway');
		endif;
		if(is_null($my_boost_slots) === false):
			$writer->tgwriteVector($my_boost_slots,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['my_boost'] = true;
		else:
			$result['my_boost'] = false;
		endif;
		$result['level'] = $reader->readInt();
		$result['current_level_boosts'] = $reader->readInt();
		$result['boosts'] = $reader->readInt();
		if($flags & (1 << 4)):
			$result['gift_boosts'] = $reader->readInt();
		else:
			$result['gift_boosts'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['next_level_boosts'] = $reader->readInt();
		else:
			$result['next_level_boosts'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['premium_audience'] = $reader->tgreadObject();
		else:
			$result['premium_audience'] = null;
		endif;
		$result['boost_url'] = $reader->tgreadBytes();
		if($flags & (1 << 3)):
			$result['prepaid_giveaways'] = $reader->tgreadVector('PrepaidGiveaway');
		else:
			$result['prepaid_giveaways'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['my_boost_slots'] = $reader->tgreadVector('int');
		else:
			$result['my_boost_slots'] = null;
		endif;
		return new self($result);
	}
}

?>