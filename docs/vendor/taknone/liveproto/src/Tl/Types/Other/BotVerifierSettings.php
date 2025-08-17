<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long icon string company true can_modify_custom_description string custom_description
 * @return BotVerifierSettings
 */

final class BotVerifierSettings extends Instance {
	public function request(int $icon,string $company,? true $can_modify_custom_description = null,? string $custom_description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb0cd6617);
		$flags = 0;
		$flags |= is_null($can_modify_custom_description) ? 0 : (1 << 1);
		$flags |= is_null($custom_description) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($icon);
		$writer->tgwriteBytes($company);
		if(is_null($custom_description) === false):
			$writer->tgwriteBytes($custom_description);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['can_modify_custom_description'] = true;
		else:
			$result['can_modify_custom_description'] = false;
		endif;
		$result['icon'] = $reader->readLong();
		$result['company'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['custom_description'] = $reader->tgreadBytes();
		else:
			$result['custom_description'] = null;
		endif;
		return new self($result);
	}
}

?>