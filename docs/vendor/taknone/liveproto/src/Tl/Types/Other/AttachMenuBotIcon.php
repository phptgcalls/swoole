<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name document icon Vector<AttachMenuBotIconColor> colors
 * @return AttachMenuBotIcon
 */

final class AttachMenuBotIcon extends Instance {
	public function request(string $name,object $icon,? array $colors = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb2a7386b);
		$flags = 0;
		$flags |= is_null($colors) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($name);
		$writer->write($icon->read());
		if(is_null($colors) === false):
			$writer->tgwriteVector($colors,'AttachMenuBotIconColor');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['name'] = $reader->tgreadBytes();
		$result['icon'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['colors'] = $reader->tgreadVector('AttachMenuBotIconColor');
		else:
			$result['colors'] = null;
		endif;
		return new self($result);
	}
}

?>